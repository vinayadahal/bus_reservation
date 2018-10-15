package Application.Models;

import Application.Config.Datasource;
import Application.ManagedBeans.BusBooking;
import System.Models.DeleteModel;
import System.Models.InsertModel;
import System.Models.SelectModel;
import System.Models.UpdateModel;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;

public class BusBookingModel {

    Datasource objDatasource = new Datasource();
    SelectModel objSelect = new SelectModel();
    InsertModel objInsert = new InsertModel();
    UpdateModel objUpdate = new UpdateModel();
    DeleteModel objDelete = new DeleteModel();

    public List<BusBooking> InnerJoinTableWhere(String tableName, String[] cols, String[] vals) {
        objSelect.select("bus.id, bus.type, bus.total_seat, bus.bus_number, bus.seat_layout, travel_agency.name as travel_agency, travel_agency.address as address, travel_agency.contact as contact, reservation.departure_date as departure_date, reservation.departure_time as departure_time, reservation.reserved_seat as reserved_seat, reservation.id as reserve_id, bus.price as price");
        objSelect.from(tableName);
        objSelect.join("reservation", "bus_id", "route", "bus_id");
        objSelect.join("bus", "id", "route", "bus_id");
        objSelect.join("travel_agency", "id", "bus", "travel_agency_id");
        objSelect.where(cols, vals);
        List<Map> result = objSelect.runQuery();
        System.out.println("Query::: " + result.toString());
        List<BusBooking> list = new ArrayList();
        for (Map buses : result) {
            BusBooking objBusBooking = new BusBooking();
            objBusBooking.setId(buses.get("id").toString());
            objBusBooking.setName(buses.get("name").toString());
            objBusBooking.setSeatLayout(buses.get("seat_layout").toString());
            objBusBooking.setAddress(buses.get("address").toString());
            objBusBooking.setTotalSeat(buses.get("total_seat").toString());
            objBusBooking.setPrice(buses.get("price").toString());
            objBusBooking.setContact(buses.get("contact").toString());
            objBusBooking.setDepartureDate(buses.get("departure_date").toString());
            objBusBooking.setType(buses.get("type").toString());
            objBusBooking.setBusNumber(buses.get("bus_number").toString());
            objBusBooking.setDepartureTime(buses.get("departure_time").toString());
            objBusBooking.setReservedSeat(buses.get("reserved_seat").toString());
            list.add(objBusBooking);
        }
        return list;
    }

}
