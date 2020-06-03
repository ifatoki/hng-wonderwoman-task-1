package main

import (
	"fmt"

)

type data struct {
	Fullname, ID, Email, Language string
}

func main() {
	mydata := data{
		Fullname: "Oladeji Oluwafemi",
		ID:       "HNG-05085",
		Email:    "oladejifemi00@gmail.com",
		Language: "GOLANG",
	}
	fmt.Printf("Hello World, this is %s, with HNG ID %s, using %s for stage 2 task, %s", 
	mydata.Fullname, mydata.ID, mydata.Language, mydata.Email)
}