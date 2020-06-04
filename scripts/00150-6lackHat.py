def Hello(full_name, ID, language, email):
    return "Hello World, this is {} with HNG ID {} using {} for stage 2 task {}".format(full_name, ID, language,email)

if __name__ == '__main__':
    full_name = "Paul Ogolla"
    ID = "HNG-00150"
    language = "Python"
    email = "paulotieno2@gmail.com"
    print(Hello(full_name, ID, language, email), flush=True)
    
