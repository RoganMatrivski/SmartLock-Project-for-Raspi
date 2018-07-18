import RPi.GPIO as GPIO
import time
GPIO.setmode(GPIO.BCM)
GPIO.setwarnings(False)

GPIO.setup(14, GPIO.OUT)
GPIO.setup(15, GPIO.OUT)
GPIO.setup(2, GPIO.OUT)
GPIO.setup(3, GPIO.OUT)

chan1stat = GPIO.input(14)
chan2stat = GPIO.input(15)
chan3stat = GPIO.input(2)
chan4stat = GPIO.input(3)

if (chan1stat and chan4stat):
    print("False");

if (chan2stat and chan3stat):
    print("True");