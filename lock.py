import RPi.GPIO as GPIO
import time
GPIO.setmode(GPIO.BCM)
GPIO.setwarnings(False)

GPIO.setup(14, GPIO.OUT)
GPIO.setup(15, GPIO.OUT)
GPIO.setup(2, GPIO.OUT)
GPIO.setup(3, GPIO.OUT)

GPIO.output(15, GPIO.HIGH)
GPIO.output(14, GPIO.LOW)
GPIO.output(2, GPIO.HIGH)
GPIO.output(3, GPIO.LOW)

print("SUCCESS")