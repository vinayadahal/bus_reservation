package ManagedBeans;

import ApplicationModels.PublicUserModel;
import java.util.ArrayList;
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

    public void setReservationId(String res_id) {
        this.res_id = res_id;
    }

    public void setStartPoint(String start_point) {
        this.start_point = start_point;
    }
    
    public String getId() {
        return id;
    }
    
    public String getName() {
        return name;
    }

    public String getReservationId() {
        return res_id;
    }

    public String getStartPoint() {
        return start_point;
    }

    public void setEndPoint(String end_point) {
        this.end_point = end_point;
    }

    public String getEndPoint() {
        return end_point;
    }

    public List<PublicUser> getAllDestination() {
        return objPublicUserModel.getAllDestinationBean("destination");
    }

    public void getSearch() {
        System.out.println("Testing");
//        System.out.println("Testing::: " + this.start_point);
    }
}
