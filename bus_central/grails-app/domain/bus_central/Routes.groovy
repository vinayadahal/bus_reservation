package bus_central

class Routes {
    static belongsTo = [start_place: Places, end_place: Places, bus: Buses]

    static constraints = {
    }
}
