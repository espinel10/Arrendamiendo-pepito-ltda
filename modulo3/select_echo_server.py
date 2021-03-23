import socket
import select
import logging

def create_nonblocking(host,port):
    logging.info('Non Blocking - creating socket')
    s = socket.socket(socket.AF_INET,socket.SOCK_STREAM)

    logging.info('Non Blocking - connecting')
    ret = s.connect_ex((host,port)) #BLOCKING

    if ret != 0:
        logging.info('Non Blocking - failed to connect!')
        return
    
    logging.info('Non Blocking - connected!')
    s.setblocking(False)

    inputs = [s]
    outputs = [s]
    while inputs:
        logging.info('Non Blocking - waiting...')
        readable,writable,exceptional = select.select(inputs,outputs,inputs,0.7)

        for s in writable:
            print('Non Blocking - sending...')
            data = s.send(b'hello\r\n')
            print(f'Non Blocking - sent: {data}')
            outputs.remove(s)

        for s in readable:
            print(f'Non Blocking - reading...')
            data = s.recv(1024)
            print(f'Non Blocking - data: {len(data)}')
            print(f'Non Blocking - closing...')
            s.close()
            inputs.remove(s)
            break

        for s in exceptional:
            print(f'Non Blocking - error')
            inputs.remove(s)
            outputs.remove(s)
            break




#Main 
def main():
    #create_blocking('voidrealms.com',80)
    logging.FileHandler('debug.log')
    create_nonblocking('192.168.1.68',8000)
    

if __name__ == "__main__":
    main()
