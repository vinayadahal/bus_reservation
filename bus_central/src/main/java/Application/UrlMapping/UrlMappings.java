package Application.UrlMapping;

import System.UrlMapping.Mapper;

public class UrlMappings extends Mapper {

    public void setRoutes() {
        map.put("index", "/public/index.xhtml");// params: url-name, controllerClassName/methodName/args
        map.put("search", "/public/search.xhtml");
        map.put("about", "AboutController/loadData");
    }

}
