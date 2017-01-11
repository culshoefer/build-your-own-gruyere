import requests
import sys
import time
import getopt
import re


def main():
    argv = sys.argv[1:]
    if len(sys.argv) < 5:
        usage()
        sys.exit()
    try:
        opts, args = getopt.getopt(argv, "w:f:p:c:")
    except getopt.GetoptError:
        print("Error in arguments")
        sys.exit()

    payload = ""
    for opt, arg in opts:
        if opt == '-w':
            url = arg
        elif opt == '-f':
            dict = arg
        elif opt == '-p':
            payload = arg
        elif opt == '-c':
            hidecode = arg

    try:
        f = open(dict, "r")
        words = f.readlines()
    except:
        print("Failed opening file: " + dict + "\n")
        sys.exit()

    launch_attack(words, url, payload)


def launch_attack(names, url, payload):
    print("Launching Attack!")
    for name in names:
        word = name.split("\n")[0]
        pl = ""
        if payload != "":
            pl = payload.replace('FUZZ', word)
        else:
            pl = payload
        attack(word, url.replace('FUZZ', word), pl)

def attack(word, url, payload):
    s = requests.Session()

    start = time.time()
    if payload == "":
        r = s.get(url)
        elaptime = time.time()
        totaltime = str(elaptime - start)[1:10]
    else:
        list = payload.replace("=", " ").replace("&", " ").split(" ")
        payload = dict([(k, v) for k,v in zip(list[::2], list[1::2])])
        r = s.post(url, data=payload)
        elaptime = time.time()
        totaltime = str(elaptime - start)[1:10]

    if 'username' in s.cookies.get_dict():
        print("PASSWORD FOUND: " + word)
        sys.exit(1)
    else:
        print("trying " + word + " time taken: " + totaltime)


main()
