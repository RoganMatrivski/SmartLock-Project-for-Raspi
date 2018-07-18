def SHA512(str):
    from cryptography.hazmat.backends import default_backend
    from cryptography.hazmat.primitives import hashes
    digest = hashes.Hash(hashes.SHA512(), backend=default_backend())
    byte_str = bytes(str, 'utf-8')
    digest.update(byte_str)
    return digest.finalize();

def HashPassword(pw, salt):
    salted_pw = pw + salt
    return SHA512(salted_pw);

import argparse

parser = argparse.ArgumentParser(description="A script for hashing uses.")
parser.add_argument("hash", help="String to Hash")
parser.add_argument("-s", "--salt", dest="salt", help="Salt to add to hash.", default="")

args = parser.parse_args()

print(bytes.hex(HashPassword(args.hash, args.salt)))