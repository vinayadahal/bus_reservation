package bus_central

class PublicController {

    def imagesService

    def index() {
        //        println "Index page called"
//        println "calling index page: images::: "+imagesService.ImagesList()
        render(view: "index")
    }
}
