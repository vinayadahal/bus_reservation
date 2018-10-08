package Application.Services;

import java.io.File;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;
import javax.faces.context.ExternalContext;
import javax.faces.context.FacesContext;

public class Commons {

    public void redirectPage(String module, String pageName, String successMsg) {
        ExternalContext ec = FacesContext.getCurrentInstance().getExternalContext();
        try {
            ec.getFlash().put("successMsg", successMsg); //setting flash message
            ec.redirect(ec.getRequestContextPath() + "/" + module + "/" + pageName + ".xhtml");
        } catch (IOException ex) {
            System.out.println("Caught IO Exception >>> " + ex);
        }
    }

    public List<String> FileList(String FilePath) {
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
