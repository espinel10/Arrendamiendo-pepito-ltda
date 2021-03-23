
import threading
import time
import logging
import socket

s=socket.socket(socket.AF_INET,socket.SOCK_STREAM)
s.settimeout(5)
puertos_abiertos=[]
puertos_cerrados=[]
def portScanner(port):
    time.sleep(1)
    host='192.168.1.54'
    if s.connect_ex((host,port)):
        puertos_cerrados.append(port)
    else:
        puertos_cerrados.append(port)
        print(port)

def worker(num):
    print('worker: %s' % num)
    cont=1
    for i in range(num*13107,(num*13107+13107)-1):
        portScanner(i)
        time.sleep(1)

threads=[]
for i in range(5):
    t=threading.Thread(target=worker,args=(i,))
    threads.append(t)
    t.start()

while True:
    pass


print(puertos_abiertos)