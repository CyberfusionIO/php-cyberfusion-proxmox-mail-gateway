<?php

namespace Cyberfusion\ProxmoxMGW\Models\Nodes\Certificates;

class CertificateInfo
{
    /**
     * @param string|null $filename
     * @param string|null $fingerprint Certificate SHA 256 fingerprint.
     * @param string|null $issuer Certificate issuer name.
     * @param int|null $notafter Certificate's notAfter timestamp (UNIX epoch).
     * @param int|null $notbefore Certificate's notBefore timestamp (UNIX epoch).
     * @param string|null $pem Certificate in PEM format
     * @param int|null $publicKeyBits Certificate's public key size
     * @param string|null $publicKeyType Certificate's public key algorithm
     * @param array|null $san List of Certificate's SubjectAlternativeName entries.
     * @param string|null $subject Certificate subject name.
     */
    public function __construct(
        public ?string $filename = null,
        public ?string $fingerprint = null,
        public ?string $issuer = null,
        public ?int $notafter = null,
        public ?int $notbefore = null,
        public ?string $pem = null,
        public ?int $publicKeyBits = null,
        public ?string $publicKeyType = null,
        public ?array $san = null,
        public ?string $subject = null,
    ) {
    }
}
