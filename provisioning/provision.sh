#!/usr/bin/env bash

BP='\033[1;35m'
END='\033[0m'

function printheading() {
  printf "${BP}${1}${END}\n"
}

if [ ! ${1} ]
then
    printheading "Please enter an environment (staging, production)" >&2
    exit 1
fi

ENVIRONMENT=${1}
PROVISION_FILES_PATH="/home/ubuntu/provisioning"
USER="app-user"

if [ ${ENVIRONMENT} == 'production' ]
then
    APP_DOMAIN="bythepixel.com"
elif [ ${ENVIRONMENT} == 'staging' ]
then
    APP_DOMAIN="staging.bythepixel.com"
fi

export DEBIAN_FRONTEND=noninteractive

printheading "Update and Upgrade Ubuntu"
sudo apt-get update -y
sudo apt-get -o Dpkg::Options::="--force-confdef" -o Dpkg::Options::="--force-confold" upgrade -y

printheading "Install software packages"
sudo apt-get install -y \
    software-properties-common \
    vim \
    unzip \
    curl \
    mysql-client \
    awscli \

printheading "Add PHP 8.1 target"
sudo add-apt-repository ppa:ondrej/php -y
sudo apt-get update -y

printheading "Install php and extensions"
sudo apt-get install -y \
    php8.1 \
    php8.1-dev \
    php8.1-curl \
    php8.1-mysql \
    php8.1-mbstring \
    php8.1-xml \
    php8.1-bcmath \
    php8.1-zip \
    php8.1-intl \
    php8.1-gd \
    php8.1-redis \

printheading "Copy php config files to /etc/php"
sudo cp ${PROVISION_FILES_PATH}/php/apache2-php.ini /etc/php/8.1/apache2/php.ini
sudo cp ${PROVISION_FILES_PATH}/php/cli-php.ini /etc/php/8.1/cli/php.ini

printheading "Install Apache2"
sudo apt-get install apache2 -y

printheading "Copy apache config files to /etc/apache2"
sudo cp ${PROVISION_FILES_PATH}/apache2/apache2.conf /etc/apache2
sudo sed -i -r "s/\{USER\}/$USER/" /etc/apache2/apache2.conf
sudo cp ${PROVISION_FILES_PATH}/apache2/000-default.conf /etc/apache2/sites-available
sudo sed -i -r "s/\{APP_DOMAIN\}/$APP_DOMAIN/" /etc/apache2/sites-available/000-default.conf

printheading "Install Supervisor"
sudo apt-get install supervisor -y
sudo mkdir /var/log/laravel-workers
sudo chown -R ${USER}:${USER} /var/log/laravel-workers

printheading "Create Unix User"
sudo adduser ${USER} --disabled-password --gecos ""

printheading "Add user to a suplementary/secondary group called 'sudo'"
sudo usermod -a -G sudo ${USER}

printheading "Make sure sudoers can sudo without password by adding to sudoers"
sudo sed -i -r "s/%sudo\t*\s*ALL=\(ALL:ALL\)\t*\s*ALL/%sudo ALL=\(ALL:ALL\) NOPASSWD: ALL/" /etc/sudoers

printheading "Add our list of keys so we can login as specified user"
sudo mkdir /home/${USER}/.ssh
sudo wget https://btp-devops.s3.amazonaws.com/authorized_keys
sudo cat ${PROVISION_FILES_PATH}/deployer.pub authorized_keys > authorized_keys_combined
sudo cp authorized_keys_combined /home/${USER}/.ssh/authorized_keys
sudo chown -R ${USER}:${USER} /home/${USER}/.ssh

printheading "Prep releases symlinking"
sudo mkdir -p /home/${USER}/releases/prep
sudo mkdir -p /srv/storage/.glide-cache
sudo mkdir -p /srv/www
sudo ln -s /home/${USER}/releases/prep /srv/www

printheading "Ensure read/write permissions are owned by app user"
sudo chown -R ${USER}:${USER} /srv/storage
sudo chown -R ${USER}:${USER} /srv/www
sudo chown -R ${USER}:${USER} /home/${USER}/releases

printheading "Disable root ssh access"
sudo sed -i "s/PermitRootLogin prohibit-password/PermitRootLogin no/" /etc/ssh/sshd_config
sudo service ssh restart

printheading "Setup Swap File"
sudo dd if=/dev/zero of=/var/swapfile bs=128M count=32 &&
sudo chmod 600 /var/swapfile &&
sudo mkswap /var/swapfile &&
echo /var/swapfile none swap defaults 0 0 | sudo tee -a /etc/fstab &&
sudo swapon -a

printheading "Enable apache mods"
sudo a2enmod headers rewrite

printheading "Restart apache"
sudo systemctl reload apache2

printheading "PROVISIONING COMPLETE"

printheading "RESTARTING SERVER"
sudo systemctl reboot
