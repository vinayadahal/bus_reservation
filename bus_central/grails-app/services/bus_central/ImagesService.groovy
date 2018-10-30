package bus_central

import grails.gorm.transactions.Transactional
import org.springframework.core.io.Resource


@Transactional
class ImagesService {
    
    def assetResourceLocator
    def assetProcessorService

    def ImagesList() {
//        println myResource.getURL()
        //        ClassLoader loader = Thread.currentThread().getContextClassLoader();
        //        def baseDir = System.getProperty( 'catalina.base' )
        //        String imagesDir = "${baseDir}/webapps/"
        //        URL url = loader.getResource(imagesDir)
        //        println imagesDir
        //        String path = url.getPath();
        //        println "PATH::::"+path
        //        return FileList(path)
    }

    def FileList(String FilePath) {
        List<String> files = new ArrayList<>();

        File folder = new File(FilePath);
        File[] listOfFiles = folder.listFiles();

        for (File listOfFile : listOfFiles) {
            if (listOfFile.isFile()) {
                files.add(listOfFile.getName());
            } else if (listOfFile.isDirectory()) {
                System.out.println("Found Directories in: " + FilePath + listOfFile.getName());
            }
        }
        return files;
    }
}
