package bus_central

class Tickets {

    String first_name
    String last_name
    String address
    String contact
    String seats
    String email
    String total_price
    String unique_id
    String from
    String to

    static belongsTo = [bus: Buses, reservation: Reservation]

    static constraints = {
    }
}
