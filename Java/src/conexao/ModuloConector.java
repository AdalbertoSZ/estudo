package conexao;

import java.sql.Connection;
import java.sql.DriverManager;

public class ModuloConector {
	public static Connection conectar() {
		java.sql.Connection conexao = null;
		String driver = "com.mysql.cj.jdbc.Driver";
		String url = "jdbc:mysql://srv1082.hstgr.io :3306/u424845166_dbfastcomp";//?useTimezone=true&serverTimezone=UTC
		String user = "u424845166_szlachta";
		String password = "Inf0l@bs";
		try {
			Class.forName(driver);
			conexao = DriverManager.getConnection(url, user, password);
			return conexao;
		} catch (Exception e) {
			System.out.println(e);
			return null;
		}
	}
}
