///Object Method

var helloWorld = {}; // create object

name = "Melissa Ugrai";  /// name property
hngId = "hng-00487";    /// HNGi7 ID property
language = "JavaScript";   /// language property

var runScript =  function()   ///run function to add string together
{
  console.log( "Hello World, this is " + this.name + " with " + this.hngId +" using " + this.language + " for Stage 2 task.");  /// console. log with string combination
};  /// end of function

runScript();  ///call function to run