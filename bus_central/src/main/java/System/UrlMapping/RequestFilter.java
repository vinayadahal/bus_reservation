package System.UrlMapping;

import Application.Config.UrlMappings;
import java.io.IOException;
import java.io.PrintWriter;
import java.io.StringWriter;
import javax.servlet.Filter;
import javax.servlet.FilterChain;
import javax.servlet.FilterConfig;
import javax.servlet.ServletException;
import javax.servlet.ServletRequest;
import javax.servlet.ServletResponse;
import javax.servlet.http.HttpServletRequest;

public class RequestFilter implements Filter {

    private static final boolean debug = true;
    private FilterConfig filterConfig = null;

    @Override
    public void doFilter(ServletRequest request, ServletResponse response, FilterChain chain)
            throws IOException, ServletException {
        HttpServletRequest req = (HttpServletRequest) request;
        String path = req.getRequestURI();//gets requested url.
        String rootDir = path.substring(1);//removes "/" from requested url.
        System.out.println(path);
        String url = UrlFilter(rootDir);
        String FilePath = UrlValidator(url);
        request.getRequestDispatcher(FilePath).forward(request, response);  // forwards requested url without applying filter.
        if (path.contains("resource") || path.contains("images")) {
            System.out.println("Calling resources::::");
            chain.doFilter(request, response);
        }

    }

    public String UrlFilter(String RootDir) {
        String requested_url = RootDir.substring(RootDir.indexOf("/") + 1); // contains everything after context path
        if (!requested_url.contains(".")) {
            return requested_url;
        } else {
            return "other_resources";
        }

    }

    public String UrlValidator(String url) {
        if (!"other_resources".equals(url) || null != url) {
            if (url.length() == 0) {
                System.out.println("URL null::: Calling default page");
                return UrlMapping("default");
            }
            String FilePath = UrlMapping(url);
            if (!"error".equals(FilePath)) {
                return FilePath;
            } else {
                System.out.println("can't call file::::");
            }
        } else {
            System.out.println("Empty URL:::");
        }
        return "test";
    }

    public String UrlMapping(String path) {
        UrlMappings objUrlMapping = new UrlMappings();
        objUrlMapping.setRoutes(); // setting routes
        if (objUrlMapping.getRoutes(path) != null) { // checking if the url mapping exsits or not for given input in the browser
            return objUrlMapping.getRoutes(path).toString();
        } else {
            System.out.println("Invalid URL showing error page"); // requires error handling
            return "error";
        }
    }

    @Override
    public String toString() {
        if (filterConfig == null) {
            return ("RequestHandler()");
        }
        StringBuilder sb = new StringBuilder("RequestHandler(");
        sb.append(filterConfig);
        sb.append(")");
        return (sb.toString());
    }

    public static String getStackTrace(Throwable t) {
        String stackTrace = null;
        try {
            StringWriter sw = new StringWriter();
            PrintWriter pw = new PrintWriter(sw);
            t.printStackTrace(pw);
            pw.close();
            sw.close();
            stackTrace = sw.getBuffer().toString();
        } catch (IOException ex) {
            System.out.println("Exception caught in filter: " + ex);
        }
        return stackTrace;
    }

    public void log(String msg) {
        filterConfig.getServletContext().log(msg);
    }

    @Override
    public void init(FilterConfig filterConfig) {
        this.filterConfig = filterConfig;
        if (filterConfig != null) {
            if (debug) {
                log("urlFilter:Initializing filter");
            }
        }
    }

    @Override
    public void destroy() {
    }

}
