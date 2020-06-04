let obj = {
    name: "Ibrahim Alao",
    id: "HNG-00198",
    email: "alaoopeyemi101@gmail.com",
    fn: function(){
           return `Hello World, this is ${this.name} with HNGi7 ID ${this.id} using Javascript for stage 2 task ${this.email}`;
    }
}
obj.fn();
