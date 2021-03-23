from socket import socket, error
from threading import Thread
from multiprocessing import Process, Queue
from queue import Empty

class  Client(Process):
    def __init__(self,conn,addr):
        Process.__init__(self)
        self.conn=conn
        self.addr=addr

    def run(self):
        input_data='dummy'
        while len(input_data):
            try:
                # Recibir datos del cliente.
                input_data = self.conn.recv(1024)
            except error:
                print("[%s] Error de lectura." % self.name)
                break
            else:
                # Reenviar la información recibida.
                if input_data:
                    self.conn.send(input_data)
                    print(input_data.decode("utf-8")) 
        print("closing connection ...")
        self.conn.close()

def main():
    s = socket()
    # Escuchar peticiones en el puerto 8000.
    s.bind(('0.0.0.0', 8000))
    s.listen(0)
    while True:
        conn, addr = s.accept()
        c = Client(conn, addr)
        c.start()
        print("%s:%d se ha conectado." % addr)
        
if __name__ == "__main__":
    main()
               