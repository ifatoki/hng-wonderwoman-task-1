def printHello(fullname, ID, email, language):
    return "Hello World, this is {} with HNGi7 ID {} and email {} using {} for stage 2 task".format(fullname, ID, email, language)

if __name__ == '__main__':
    fullname = "Mahalinoro Razafimanjato"
    ID = "HNG-01694"
    language = "Python"
    email = "m.razafiman@alustudent.com"
    print(printHello(fullname, ID, email, language), flush=True)



