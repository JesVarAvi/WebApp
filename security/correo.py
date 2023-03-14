import os
import smtplib
import imghdr
from email.message import EmailMessage
import numpy as np
import cv2
import sys
import mysql.connector
import datetime
import RPi.GPIO as GPIO
import time
import requests



def get_users(host,user,password,database):
    try:
        db = mysql.connector.connect(host = host, user = user, password = password, database = database)
        cursor = db.cursor()
        query = "SELECT * FROM Users;"
        cursor.execute(query)
    except Exception as e:
        print(("Ocurrió una excepción: {0}").format(e))
        db.rollback()
        db.close()
        return 0
    else:
        registers = cursor.fetchall()
        db.close()
        return registers

def send_email_msg(subject,address_to,photo_path,FileName):
    EMAIL_ADDRESS = "jva756@gmail.com"
    EMAIL_PASSWORD = "kfupmyundcbcpymt"
    msg = EmailMessage()
    msg['Subject'] = subject
    msg['From'] = EMAIL_ADDRESS
    msg['To'] = address_to
    photo_path = "/home/Pictures/temp.jpg"
    with open(photo_path, "rb") as f:
        file_data = f.read()
        file_type = imghdr.what(f.name)
        file_name = f.name
    msg.add_attachment(file_data,maintype="image",subtype=file_type,filename=(FileName+".jpg"))
    '''msg.set_content("This is a plain text email")
    msg.add_alternative(html, subtype='html')'''
    with smtplib.SMTP_SSL('smtp.gmail.com',465) as smtp:
        smtp.login(EMAIL_ADDRESS, EMAIL_PASSWORD)
        smtp.send_message(msg)

def send_telegram_msg():
    files = {'photo':open('/home/Pictures/temp.jpg','rb')}
    resp = requests.post('https://api.telegram.org/bot1814191077:AAEy2JbBDv0Aks2udwX9OYY_npRHT2fqX_o/sendPhoto?chat_id=-1001366406570&caption=¡Alerta de seguridad!', files = files)

def take_photo(frameIA):
    #cap = cv2.VideoCapture(0)
    #ret,frame = cap.read()
    now = datetime.datetime.now()
    date = str(now.day) + '-' + str(now.month) + '-' + str(now.year) + '_' + str(now.hour) + ':' +str(now.minute)
    filename = "capture_" + date
    cv2.putText(frameIA, str(now.strftime("%c")), (0, 30), cv2.FONT_HERSHEY_SIMPLEX,1, (255, 0, 0) , 2, cv2.LINE_AA)
    path = "/var/www/jesusvargas.ejemplo.com/fotos/{0}.jpg".format(filename)
    cv2.imwrite(path,frameIA)
    img_header = cv2.imread("/home/Pictures/header.jpg")
    im_v = cv2.vconcat([img_header, frameIA])
    cv2.imwrite("/home/Pictures/temp.jpg",im_v)
    #cap.release() 
    return path,filename,now

def take_video(now):
    capture_duration = 5
    cap = cv2.VideoCapture(0)
    fourcc = cv2.VideoWriter_fourcc(*'H264')
    date = str(now.day) + '-' + str(now.month) + '-' + str(now.year) + '_' + str(now.hour) + ':' +str(now.minute)
    filename = "vcapture_" + date
    path = "/var/www/jesusvargas.ejemplo.com/videos/{0}.mp4".format(filename)
    out = cv2.VideoWriter(path,fourcc, 20.0, (640,480))
    start_time = time.time()
    while( int(time.time() - start_time) < capture_duration ):
        ret, frame = cap.read()
        if(ret == True):
            cv2.putText(frame, str(now.strftime("%c")), (0, 30), cv2.FONT_HERSHEY_SIMPLEX,1, (255, 0, 0) , 2, cv2.LINE_AA)
            out.write(frame)
        else:
            break
    cap.release()
    out.release()
    return path,filename

def send(frame):
    path_photo,filename_photo,now_photo = take_photo(frame)
    users = get_users("localhost","pi_db","db3287_","Test")
    for row in users:
        send_email_msg("CVChidori: Captura de seguridad ({0})".format(filename_photo),row[0],path_photo,filename_photo)
    send_telegram_msg()
    path_video,filename_video = take_video(now_photo)



try:
    cap = cv2.VideoCapture(0)
    faceClassif = cv2.CascadeClassifier('/var/www/jesusvargas.ejemplo.com/haarcascade_face.xml')
    while(True):
        ret,frame = cap.read()
        gray = cv2.cvtColor(frame,cv2.COLOR_BGR2GRAY)
        faces = faceClassif.detectMultiScale(gray,1.3,5)
        for(x,y,w,h) in faces:
            cv2.rectangle(frame,(x,y),(x+w,y+h),(0,255,0),2)
        '''cv2.imshow('frame',frame)
        if(cv2.waitKey(1) & 0xFF == ord('q')):
            break'''
        if(len(faces) > 0):
            cap.release()
            send(frame)
            cap = cv2.VideoCapture(0)
            faceClassif = cv2.CascadeClassifier('/var/www/jesusvargas.ejemplo.com/haarcascade_face.xml')
except KeyboardInterrupt:
    cap.release()
    cv2.destroyAllWindows()
    print("ALV!")

