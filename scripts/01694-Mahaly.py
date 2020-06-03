def printHello(fullname, ID, language):
    return "Hello World, this is {} with HNGi7 ID {} using {} for stage 2 task".format(fullname, ID, language)

if __name__ == '__main__':
    fullname = "Mahalinoro Razafimanjato"
    ID = "01694"
    language = "Python"
    print(printHello(fullname, ID, language), flush=True)



