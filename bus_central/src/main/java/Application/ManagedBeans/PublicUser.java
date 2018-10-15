package Application.ManagedBeans;

import Application.Models.PublicUserModel;
import java.util.List;
import javax.faces.bean.ManagedBean;
import javax.faces.bean.RequestScoped;

@ManagedBean(name = "mbPublicUser")
@RequestScoped
public class PublicUser {

    private String id;
    private String name;
    private String res_id;
    private String start_point;
    private String end_point;

    PublicUserModel objPublicUserModel = new PublicUserModel();

    public void setId(String id) {
        this.id = id;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getId() {
        return id;
    }

    public String getName() {
        return name;
    }

    public List<PublicUser> getAllDestination() {
        return objPublicUserModel.getAll("destination");
    }

}
