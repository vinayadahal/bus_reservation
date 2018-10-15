package Application.ManagedBeans;

import Application.Models.BusBookingModel;
import Application.Models.PublicUserModel;
import java.util.List;
import java.util.Map;
import javax.faces.bean.ManagedBean;
import javax.faces.bean.RequestScoped;
import javax.faces.context.FacesContext;

@ManagedBean(name = "mbBusBooking")
@RequestScoped
public class BusBooking {

    private String id;
    private String seat_layout;
    private String address;
    private String total_seat;
    private String price;
    private String contact;
    private String departure_date;
    private String name;
    private String type;
    private String bus_number;
    private String departure_time;
    private String reserved_seat;

    PublicUserModel objPublicUserModel = new PublicUserModel();
    Map<String, String> params;

    public void setId(String id) {
        this.id = id;
    }

    public void setSeatLayout(String seat_layout) {
        this.seat_layout = seat_layout;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public void setTotalSeat(String total_seat) {
        this.total_seat = total_seat;
    }

    public void setPrice(String price) {
        this.price = price;
    }

    public void setContact(String contact) {
        this.contact = contact;
    }

    public void setDepartureDate(String departure_date) {
        this.departure_date = departure_date;
    }

    public void setName(String name) {
        this.name = name;
    }

    public void setType(String type) {
        this.type = type;
    }

    public void setBusNumber(String bus_number) {
        this.bus_number = bus_number;
    }

    public void setDepartureTime(String departure_time) {
        this.departure_time = departure_time;
    }

    public void setReservedSeat(String reserved_seat) {
        this.reserved_seat = reserved_seat;
    }

    public String getId() {
        return id;
    }

    public String getSeatLayout() {
        return seat_layout;
    }

    public String getAddress() {
        return address;
    }

    public String getTotalSeat() {
        return total_seat;
    }

    public String getPrice() {
        return price;
    }

    public String getContact() {
        return contact;
    }

    public String getDepartureDate() {
        return departure_date;
    }

    public String getName() {
        return name;
    }

    public String getType() {
        return type;
    }

    public String getBusNumber() {
        return bus_number;
    }

    public String getDepartureTime() {
        return departure_time;
    }

    public String getReservedSeat() {
        return reserved_seat;
    }

    public void initParams() {
        FacesContext fc = FacesContext.getCurrentInstance();
        params = fc.getExternalContext().getRequestParameterMap();
    }

    public List<BusBooking> getBusResult() {
        System.out.println("Testing");
        this.initParams();
        String start = params.get("start_point");
        String end = params.get("end_point");
        String date = params.get("date");
        System.out.println("querying::::");
        String[] cols = {"route.start_point", "route.end_point", "reservation.departure_date"};
        String[] vals = {start, end, date};

        return new BusBookingModel().InnerJoinTableWhere("route", cols, vals);
//        return "test";
//        System.out.println("Testing::: " + this.start_point);
    }

}
