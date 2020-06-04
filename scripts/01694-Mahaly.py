def printHello(fullname, ID, email, language):
    return "Hello World, this is {} with HNGi7 ID {} using {} for stage 2 task {}".format(fullname, ID, language, email)

if __name__ == '__main__':
    fullname = "Mahalinoro Razafimanjato"
    ID = "HNG-01694"
    language = "Python"
    email = "m.razafiman@alustudent.com"
    print(printHello(fullname, ID, email, language), flush=True)



