def printHello(fullname, ID, lang, email_address):
    return "Hello World, this is {} with HNGi7 ID {} using {} for stage 2 task {}".format(fullname, ID, lang,email_address)

if __name__ == '__main__':
    fullname = "Jinet Onyango"
    ID = "HNG-06309"
    lang = "Python"
    email_address="jeanadagi@gmail.com"
    print(printHello(fullname, ID, lang,email_address), flush=True)




