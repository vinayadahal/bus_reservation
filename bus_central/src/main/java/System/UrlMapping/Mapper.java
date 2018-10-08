package System.UrlMapping;

import java.util.HashMap;
import java.util.Map;

public class Mapper {

    public Map map = new HashMap();

    public Object getRoutes(String key) {
        Object value = map.get(key);
        if (value != null) {
            return map.get(key);
        }
        return null;
    }
}
