<?php

return [
    /**
     * Determines whether WWW Redirection should be enabled, disabled or skipped
     *
     * If set to true, this enables Forced WWW Redirection in Production (on Non-Admin Domains)
     *
     * If set to false, this enables Forced Non-WWW Redirection in Production (www.example.com -> example.com)
     *
     * If set to null, this middleware will do nothing and no redirection will occur
     *
     */
    'enabled' => null,
];
