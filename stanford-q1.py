import base64
import hashlib
import os
import binascii

def pad(s):
    return s + b'{' + (os.urandom(ord(s[-1]) - len(s) - 1) if len(s) % 16 != 0 else b'')

def unpad(s):
    return s[:-1 - s[-1:].find(b'{')]

def encrypt(key, plaintext):
    iv = os.urandom(16)
    cipher = AES.new(key, AES.MODE_CBC, iv)
    ciphertext = iv + cipher.encrypt(pad(plaintext))
    return base64.b64encode(ciphertext).decode('utf-8')

def decrypt(key, ciphertext):
    ciphertext = base64.b64decode(ciphertext)
    iv = ciphertext[:16]
    cipher = AES.new(key, AES.MODE_CBC, iv)
    plaintext = unpad(cipher.decrypt(ciphertext[16:]))
    return plaintext.decode('utf-8')