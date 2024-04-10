import os

class File:
    def __init__(self, path):
        if not os.path.isfile(path) or os.path.basename(path).startswith('/safedir'):
            raise ValueError("Invalid file path")
        self.path = path

    def read(self, size=-1):
        with open(self.path, 'rb') as file:
            return file.read(size)

    def write(self, data):
        with open(self.path, 'wb') as file:
            file.write(data)

    def __enter__(self):
        return self

    def __exit__(self, exc_type, exc_value, traceback):
        pass

def open_file(path):
    if not os.path.isfile(path) or os.path.basename(path).startswith('/safedir'):
        raise ValueError("Invalid file path")
    return File(path)