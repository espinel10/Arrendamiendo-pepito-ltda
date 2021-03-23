import threading
import time
import logging
import socket
from multiprocessing import Process, Queue
from queue import Empty

s=socket.socket(socket.AF_INET,socket.SOCK_STREAM)
s.settimeout(5)

def portScanner(port):
    host='192.168.1.53'
    if s.connect_ex((host,port)):
        pass
    else:
        print("puerto abierto:",port)

def worker(q):
    while True:
        try:
            port=q.get_nowait()
        except Empty:
            break
        else:
            time.sleep(1)
            portScanner(port)
    
    
    
def main():
    puertos=list(range(1,65535))
    q=Queue(len(puertos))
    for p in puertos:
        q.put(p)
    procesos=[]
    for i in range(5):
        procesos.append(Process(target=worker,args=(q,)))
        procesos[i].start()
        print("procesos %d lanzado "%(i+1))
    for pro in procesos:
        pro.join()
    
    print("la ejecucion a concluido")
   

if __name__=="__main__":
    main()