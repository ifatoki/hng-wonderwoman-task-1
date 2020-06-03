def printHello(fullname, ID, lang):
    return "Hello World, this is {} with HNGi7 ID {} using {} for stage 2 task".format(fullname, ID, lang)

if __name__ == '__main__':
    fullname = "Jinet Onyango"
    ID = "HNG-06309"
    lang = "Python"
    print(printHello(fullname, ID, lang), flush=True)




