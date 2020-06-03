def Hello(full_name, ID, email, language):
    return "Hello World, this is {} with HNGi7 ID {} and email address {} using {} for stage 2 task".format(full_name, ID, email, language)

if __name__ == '__main__':
    full_name = "Paul Ogolla"
    ID = "HNG-00150"
    email = "paulotieno2@gmail.com"
    language = "Python"
    print(Hello(full_name, ID, email, language), flush=True)
