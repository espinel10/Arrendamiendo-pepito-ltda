import signal

def handler_senal(signum,stack_frame):
    print("I have encountered the signal Kill.")
    print("CTRL+C was pressed . Do anything here before the process exits")


signal.signal(signal.SIGKILL,handler_senal)