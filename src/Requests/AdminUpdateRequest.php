<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

class AdminUpdateRequest
{
    /**
     * @param bool|null $advfilter Enable advanced filters for statistic.
     * @param bool|null $avast Use Avast Virus Scanner (/usr/bin/scan). You need to buy and install 'Avast Core Security' before you can enable this feature.
     * @param bool|null $clamav Use ClamAV Virus Scanner. This is the default virus scanner and is enabled by default.
     * @param bool|null $custom_check Use Custom Check Script. The script has to take the defined arguments and can return Virus findings or a Spamscore.
     * @param string|null $custom_check_path Absolute Path to the Custom Check Script
     * @param bool|null $dailyreport Send daily reports.
     * @param string|null $delete A list of settings you want to delete.
     * @param bool|null $demo Demo mode - do not start SMTP filter.
     * @param string|null $digest Prevent changes if current configuration file has a different digest. This can be used to prevent concurrent modifications.
     * @param string|null $dkim_use_domain Whether to sign using the address from the header or the envelope.
     * @param string|null $dkim_selector Default DKIM selector
     * @param bool|null $dkim_sign DKIM sign outbound mails with the configured Selector.
     * @param bool|null $dkim_sign_all_mail DKIM sign all outgoing mails irrespective of the Envelope From domain.
     * @param string|null $email Administrator E-Mail address.
     * @param string|null $http_proxy Specify external http proxy which is used for downloads (example: 'http://username:password@host:port/')
     * @param int|null $statlifetime User Statistics Lifetime (days)
     */
    public function __construct(
        private ?bool $advfilter = null,
        private ?bool $avast = null,
        private ?bool $clamav = null,
        private ?bool $custom_check = null,
        private ?string $custom_check_path = null,
        private ?bool $dailyreport = null,
        private ?string $delete = null,
        private ?bool $demo = null,
        private ?string $digest = null,
        private ?string $dkim_use_domain = null,
        private ?string $dkim_selector = null,
        private ?bool $dkim_sign = null,
        private ?bool $dkim_sign_all_mail = null,
        private ?string $email = null,
        private ?string $http_proxy = null,
        private ?int $statlifetime = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'advfilter' => $this->advfilter,
            'avast' => $this->avast,
            'clamav' => $this->clamav,
            'custom_check' => $this->custom_check,
            'custom_check_path' => $this->custom_check_path,
            'dailyreport' => $this->dailyreport,
            'delete' => $this->delete,
            'demo' => $this->demo,
            'digest' => $this->digest,
            'dkim-use-domain' => $this->dkim_use_domain,
            'dkim_selector' => $this->dkim_selector,
            'dkim_sign' => $this->dkim_sign,
            'dkim_sign_all_mail' => $this->dkim_sign_all_mail,
            'email' => $this->email,
            'http_proxy' => $this->http_proxy,
            'statlifetime' => $this->statlifetime,
        ], fn($value) => $value !== null);
    }
}
