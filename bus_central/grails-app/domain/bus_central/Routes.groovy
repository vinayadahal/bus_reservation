package bus_central

class Routes {
    static belongsTo = [start_point: Places, end_point: Places, bus: Buses]

    static constraints = {
    }
}
