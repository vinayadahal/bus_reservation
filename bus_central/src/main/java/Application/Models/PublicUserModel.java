package Application.Models;

import Application.Config.Datasource;
import Application.ManagedBeans.PublicUser;
import System.Models.DeleteModel;
import System.Models.InsertModel;
import System.Models.SelectModel;
import System.Models.UpdateModel;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;

public class PublicUserModel {

    Datasource objDatasource = new Datasource();
    SelectModel objSelect = new SelectModel();
    InsertModel objInsert = new InsertModel();
    UpdateModel objUpdate = new UpdateModel();
    DeleteModel objDelete = new DeleteModel();

    public List<PublicUser> getAll(String tableName) {
        objSelect.select("*");
        objSelect.from(tableName);
        List<Map> result = objSelect.runQuery();
        List<PublicUser> list = new ArrayList();
        for (Map destination : result) {
            PublicUser objPublicUser = new PublicUser();
            objPublicUser.setId(destination.get("id").toString());
            objPublicUser.setName(destination.get("name").toString());
            list.add(objPublicUser);
        }
        return list;
    }

    public List<PublicUser> InnerJoinTableWhere(String tableName) {
        objSelect.select("*");
        objSelect.from(tableName);
        objSelect.join("reservation", "bus_id", "route", "bus_id");
        objSelect.join("bus", "id", "route", "bus_id");
        objSelect.join("travel_agency", "id", "bus", "travel_agency_id");
//        objSelect.where("travel_agency", "id", "bus", "travel_agency_id");
        System.out.println("Query:::::::::::::::::::");
        List<Map> result = objSelect.runQuery();
        List<PublicUser> list = new ArrayList();
        return list;
    }

}
