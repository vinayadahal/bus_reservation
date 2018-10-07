package ApplicationModels;

import DataSource.Datasource;
import ManagedBeans.PublicUser;
import SystemModels.DeleteModel;
import SystemModels.InsertModel;
import SystemModels.SelectModel;
import SystemModels.UpdateModel;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;

public class PublicUserModel {

    Datasource objDatasource = new Datasource();
    SelectModel objSelect = new SelectModel();
    InsertModel objInsert = new InsertModel();
    UpdateModel objUpdate = new UpdateModel();
    DeleteModel objDelete = new DeleteModel();

    public List<PublicUser> getAllDestinationBean(String tableName) {
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

}
