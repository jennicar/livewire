# Provisioning

## Create a New Amazon EC2 Instance
- Log in to the Amazon Console
- Services > EC2 > Instances
- Click Launch Instance
- Select **Ubuntu 18.04** Server
- Select **t2.micro** Type > Next: Configure Instance Details
- Check **Protect against accidental termination** > Next: Add Storage
- Leave as default > Next: Add Tags
- Leave as default > Next: Configure Security Group
- Click **Select an existing security group**. Choose **Basic Load Balanced Webserver** > Review and Launch
- Click Launch > Choose an existing key pair. Select yours. If not added, talk to someone with ability to add new SSH key pairs. Click Launch Instances. Navigate back to the Instances view

## SSHing into Server and Provisioning
- Ensure you can SSH into the server by navigating to your terminal and running:
  `ssh ubuntu@<public_ip>`. You can get the public IP by selecting the EC2 instance from the Intances view on the Amazon console
- Exit the SSH session
- Navigate to the application project root from the command line
- Copy the provisioning folder by running the following command:
  `scp -rp ./provisioning ubuntu@<public_ip>:/home/ubuntu/provisioning`
- `ssh ubuntu@<public_ip>`
- `cd /home/ubuntu/provisioning`
- Run the provisioning script by `./provision.sh [env]` (local, dev, staging, prod)
- Ensure the process completes successfully
- The server will automatically reboot on success and will exit you out of the SSH Session automatically
- SSH into the server again as `app-user` via `ssh app-user@<public_ip>`
- Cleanup Default EC2 User: `sudo userdel ubuntu -f`
