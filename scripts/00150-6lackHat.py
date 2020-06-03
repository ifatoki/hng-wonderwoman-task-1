def Hello(full_name, ID, language):
    return "Hello World, this is {} with HNG ID {} using {} for stage 2 task".format(full_name, ID, language)

if __name__ == '__main__':
    full_name = "Paul Ogolla"
    ID = "HNG-00150"
    language = "Python"
    print(Hello(full_name, ID, language), flush=True)
