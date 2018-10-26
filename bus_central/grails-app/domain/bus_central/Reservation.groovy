package bus_central

import java.sql.Time

class Reservation {
    Date departure_date_time
    String reserved_seat

    static belongsTo = [bus: Buses]

    static constraints = {
    }
}
