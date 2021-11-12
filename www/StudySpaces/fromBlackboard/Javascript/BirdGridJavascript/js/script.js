function O(i) {
	return document.getElementById(i)
}
function S(i) {
	return O(i).style
	}
function showbird(num){
   	bird = ["bluebird","cardinal","goldfinch"]
  	O("title").innerHTML = bird[num]
  	O("birdphoto").setAttribute("src","images/" + bird[num] + ".jpg")
  	var text = O("description")
  	var more = O("more")
  	switch (num) {
  		case 0:
  			text.innerHTML = "The bluebirds are a group of medium-sized, mostly insectivorous" + 
  			" or omnivorous birds in the order of Passerines in the genus Sialia of the thrush family (Turdidae)." + 
  			" Bluebirds are one of the few thrush genera in the Americas. They have blue, or blue and rose beige, plumage. " 
  			more.innerHTML = "Female birds are less brightly colored than males, although color patterns are " + 
  			"similar and there is no noticeable difference in size between the two sexes. "
			S('title').color = 'blue'
  			break
  		case 1:
  			text.innerHTML = "The northern cardinal (Cardinalis cardinalis) is a bird in the genus Cardinalis; it is also known" + 
  			" colloquially as the redbird, common cardinal or just cardinal (which was its name prior to 1985)."
  			more.innerHTML = " It can be found in southern eastern Canada, through the eastern United States" + 
  			" from Maine to Minnesota to Texas, and south through Mexico, Belize, Guatemala and Big Island of Hawai’i." + 
  			" Its habitat includes woodlands, gardens, shrublands, and wetlands."
  			S('title').color = 'red'
  			break
  		case 2:
  			text.innerHTML = "The American goldfinch (Spinus tristis) is a small North American bird in the finch family."
  			more.innerHTML = " It is migratory, ranging from mid-Alberta to North Carolina during the breeding season,"+
  			" and from just south of the Canada–United States border to Mexico during the winter."
  			S('title').color = 'gold'
  			break
  		}
  }
function setBackground(num){
  	switch (num){
  		case 0:
  			S('Bluebird').background='blue'
  			S('Bluebird').color='white'
  			break
  		case 1:
  			S('Cardinal').background='red'
  			break
  		case 2:
  			S('GoldFinch').background='gold'
  			break
  		case 10:
  			S('Bluebird').background='white'
  			S('Bluebird').color='black'
  			break
  		case 11:
  			S('Cardinal').background='white'
  			break
  		case 12:
  			S('GoldFinch').background='white'
  			break
  		}
  }