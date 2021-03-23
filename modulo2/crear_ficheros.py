from subprocess import call
import random
import os
rutas=[]

call(['mkdir','prueba'])

def gen_nombres():
    tam=8
    nombre=[]
    abc="abcdefghijkmnlopqrstvuxwyzABCDEFHIJKMNLOPQRSTVUXWYZ0123456789"
    abc=list(abc)
    for i in range(tam):
        num=random.randint(0,len(abc)-1)
        nombre.append(abc[num])
    return "".join(nombre)


def gen_dir(PATH,prof):
    if prof>10:
        rutas.append(PATH)
        return
    num=random.randint(1,5)
    for i in range(1,num):
        new_hijo=gen_nombres()
        PATH2=PATH+"/"+new_hijo
        call(['mkdir',PATH2])
        gen_dir(PATH2,prof+1)


gen_dir('prueba',0)
num=random.randint(0,len(rutas))
CTF=rutas[num]
file=open(CTF+"/"+"bandera.txt","w")
file.write("NAGATOMO was here")
file.close()
print(CTF)

