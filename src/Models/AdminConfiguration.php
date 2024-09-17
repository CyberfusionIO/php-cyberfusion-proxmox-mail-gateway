<?php

namespace Cyberfusion\ProxmoxMGW\Models;

class AdminConfiguration
{
    /**
     * @param bool|null $advfilter Enable advanced filters for statistic.
     * @param bool|null $avast Use Avast Virus Scanner (/usr/bin/scan). You need to buy and install 'Avast Core Security' before you can enable this feature.
     * @param bool|null $clamav Use ClamAV Virus Scanner. This is the default virus scanner and is enabled by default.
     * @param bool|null $custom_check Use Custom Check Script. The script has to take the defined arguments and can return Virus findings or a Spamscore.
     * @param string|null $custom_check_path Absolute Path to the Custom Check Script
     * @param bool|null $dailyreport Send daily reports.
     * @param bool|null $demo Demo mode - do not start SMTP filter.
     * @param string|null $dkim_use_domain Whether to sign using the address from the header or the envelope.
     * @param string|null $dkim_selector Default DKIM selector
     * @param bool|null $dkim_sign DKIM sign outbound mails with the configured Selector.
     * @param bool|null $dkim_sign_all_mail DKIM sign all outgoing mails irrespective of the Envelope From domain.
     * @param string|null $email Administrator E-Mail address.
     * @param string|null $http_proxy Specify external http proxy which is used for downloads (example: 'http://username:password@host:port/')
     * @param int|null $statlifetime User Statistics Lifetime (days)
     */
    public function __construct(
        public ?bool $advfilter = null,
        public ?bool $avast = null,
        public ?bool $clamav = null,
        public ?bool $custom_check = null,
        public ?string $custom_check_path = null,
        public ?bool $dailyreport = null,
        public ?bool $demo = null,
        public ?string $dkim_use_domain = null,
        public ?string $dkim_selector = null,
        public ?bool $dkim_sign = null,
        public ?bool $dkim_sign_all_mail = null,
        public ?string $email = null,
        public ?string $http_proxy = null,
        public ?int $statlifetime = null,
    ) {
    }
}
