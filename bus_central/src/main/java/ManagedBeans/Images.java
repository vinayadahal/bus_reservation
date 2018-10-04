package ManagedBeans;

import Services.Commons;
import java.net.URL;
import java.util.List;
import javax.faces.bean.ManagedBean;
import javax.faces.bean.RequestScoped;

@ManagedBean(name = "mbImages")
@RequestScoped
public class Images {

    Commons objCommons = new Commons();

    public void setImageList() {

    }

    public List<String> getImageList() {
        ClassLoader loader = Thread.currentThread().getContextClassLoader();
        URL url = loader.getResource("../../resources/images/slider/");
        String path = url.getPath();
        return objCommons.FileList(path);
    }

}
