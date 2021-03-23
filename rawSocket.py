#!/usr/bin/python2

import struct
import socket
import binascii
#struct.pack("B",1)
#'\x01'
#inverso 
#struct.unpack("!L","\x00\x00\x00\01")
#salida (1,)
# ! L H etcsech
## 0x0800 --->nano /usr/include/linux/if_ether.h  
rawSocket = socket.socket(socket.PF_PACKET , socket.SOCK_RAW , socket.htons(0x0800))
pkt = rawSocket.recvfrom(2048)

ethernetHeader = pkt[0][0:14]
eth_hdr = struct.unpack("!6s6s2s",ethernetHeader)

binascii.hexlify(eth_hdr[0])

binascii.hexlify(eth_hdr[1])

binascii.hexlify(eth_hdr[2])

ipHeader = ptk[0][14:34]

ip_hdr=struct.unpack("!12s4s4s",ipHeader)

print ("Source IP address : "+ socket.inet_ntoa(ip_hdr[1]))
print ("Destination IP address: "+socket.inet_ntoa(ip_hdr[2]))

#initial part of the tcp header

tcpHeader = pkt[0][34:54]
tcp_hdr=struct.unpack("!HH16s",tcpHeader)


