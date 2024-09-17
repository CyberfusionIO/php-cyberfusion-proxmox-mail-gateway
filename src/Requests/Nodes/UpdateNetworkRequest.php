<?php

namespace Cyberfusion\ProxmoxPVE\Requests\Nodes;

class UpdateNetworkRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string $iface Network interface name.
     * @param string|null $type Network interface type
     * @param string|null $address IP address.
     * @param string|null $netmask Network mask.
     * @param string|null $gateway Default gateway address.
     * @param bool|null $autostart Automatically start interface on boot.
     * @param string|null $comments Comments
     * @param int|null $mtu MTU.
     * @param string|null $bondMode Bonding mode.
     * @param string|null $bondPrimary Specify the primary interface for active-backup bond.
     * @param string|null $bridgePorts Specify the interfaces you want to add to your bridge.
     * @param bool|null $bridgeVlanAware Enable bridge vlan support.
     * @param string|null $delete A list of settings you want to delete.
     */
    public function __construct(
        public string $node,
        public string $iface,
        public ?string $type = null,
        public ?string $address = null,
        public ?string $netmask = null,
        public ?string $gateway = null,
        public ?bool $autostart = null,
        public ?string $comments = null,
        public ?int $mtu = null,
        public ?string $bondMode = null,
        public ?string $bondPrimary = null,
        public ?string $bridgePorts = null,
        public ?bool $bridgeVlanAware = null,
        public ?string $delete = null,
    ) {
    }
}
