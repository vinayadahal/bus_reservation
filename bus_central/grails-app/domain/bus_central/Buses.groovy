package bus_central

class Buses {

    String type
    String total_seat
    String bus_number
    String price
    String seat_layout
//    String travel_agency_id

    static belongsTo = [agency: Agency]
    static constraints = {
    }

}
