import random
import time
from datetime import datetime

hash = random.getrandbits(64)

while True:
    dt = datetime.now()
    print("%s %016x" % (dt,hash), flush=True)
    time.sleep(5)
