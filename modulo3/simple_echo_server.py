import socket
import sys
import threading
import time

tcpSocket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
tcpSocket.setsockopt(socket.SOL_SOCKET,socket.SO_REUSEADDR,1)
tcpSocket.bind(('0.0.0.0',8000))
tcpSocket.listen(2)
print("Waiting for a client...")
(client,(ip,sock))=tcpSocket.accept()
print("Received connection from: ",ip)
print("Starting ECHO output.....")
data= 'dummy'
while len(data):
    time.sleep(1)
    data=client.recv(2048)
    print("Client sent: ",data.decode("utf-8"))
    client.send(data)
print("closing connection ...")
client.close()





