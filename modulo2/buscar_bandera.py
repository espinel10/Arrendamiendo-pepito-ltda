import os 
from subprocess import PIPE,Popen
from subprocess import call
import re
rutas=[]
camino=[]
def gen_arbol(PATH):
    comando=['ls']
    comando.append(PATH)
    comando.append('-lh')
    proceso = Popen(comando, stdout=PIPE, stderr=PIPE)
    listado = proceso.stdout.read()
    listado=str(listado).split('\\n')
    listado.pop(0)
    listado.pop()

    if len(listado)==0:
        rutas.append(PATH)
        return
  
    for i in listado:
        j=i.split(' ')
        if i[0]=='d':
            new_PATH=PATH+"/"+j[-1]
            gen_arbol(new_PATH)
        else:
            print(j[-1])
            Test_String=j[-1]
            Regex_Pattern = r'[A-Za-z0-9]*.txt$'
            match = re.findall(Regex_Pattern, Test_String)
            if len(match)!=0:
                camino.append(PATH+"/"+Test_String)
                rutas.append(PATH+"/"+Test_String)
                break

    

gen_arbol('prueba')
print("la ruta al documento es:")
print(camino[0])

