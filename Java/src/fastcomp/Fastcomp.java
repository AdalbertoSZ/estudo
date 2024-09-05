package fastcomp;

import java.awt.Cursor;
import java.awt.EventQueue;
import java.awt.Font;
import java.awt.Toolkit;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;

import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JPasswordField;
import javax.swing.JTextField;
import javax.swing.border.EmptyBorder;

import conexao.ModuloConector;

public class Fastcomp extends JFrame {

	private static final long serialVersionUID = 1L;
	private JPanel telaLogin;
	private JTextField txtUser;
	private JPasswordField txtPassword;
	public String id;
	
	Connection conexao = null;
	PreparedStatement pst = null;
	ResultSet rs = null;
	public void logar() {
		conexao = ModuloConector.conectar();
		String sql = "select * from Clientes where login=? and senha=?";
		try {
			pst = conexao.prepareStatement(sql);
			pst.setString(1, txtUser.getText());
			String captura = new String(txtPassword.getPassword());
			pst.setString(2, captura);
			rs = pst.executeQuery();
			if (rs.next()) {
				//JOptionPane.showMessageDialog(null, "Bem vindo ao sistema de coleta de dados de impressoras");
				String cliente = rs.getString("Cliente");
				String id = rs.getString("Indice");
				TelaPrincipal principal = new TelaPrincipal();
				principal.setVisible(true);
				TelaPrincipal.lblCliente.setText(cliente);
				TelaPrincipal.lblIdcli.setText(id);
				this.dispose();
			} else {
				JOptionPane.showMessageDialog(null, "Usuário e/ou senha inválido(s)");
			}
			conexao.close();
		} catch (Exception e2) {
			JOptionPane.showMessageDialog(null, e2);
		}
	}

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					Fastcomp frame = new Fastcomp();
					frame.setVisible(true);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		});
	}

	/**
	 * Create the frame.
	 */
	public Fastcomp() {
		setResizable(false);
		setTitle("Fastcomp - Login");
		setIconImage(Toolkit.getDefaultToolkit().getImage(Fastcomp.class.getResource("/fastcomp/favicon.ico")));
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 450, 300);
		telaLogin = new JPanel();
		telaLogin.setBorder(new EmptyBorder(5, 5, 5, 5));

		setContentPane(telaLogin);
		telaLogin.setLayout(null);
		
		JLabel lblUser = new JLabel("Usuário");
		lblUser.setFont(new Font("SansSerif", Font.PLAIN, 14));
		lblUser.setBounds(30, 60, 80, 16);
		telaLogin.add(lblUser);
		
		JLabel lblPassword = new JLabel("Senha");
		lblPassword.setFont(new Font("SansSerif", Font.PLAIN, 14));
		lblPassword.setBounds(30, 120, 80, 16);
		telaLogin.add(lblPassword);
		
		txtUser = new JTextField();
		txtUser.setFont(new Font("SansSerif", Font.PLAIN, 14));
		txtUser.setBounds(90, 58, 276, 28);
		telaLogin.add(txtUser);
		txtUser.setColumns(10);
		
		JLabel lblStatus = new JLabel("");
		lblStatus.setIcon(new ImageIcon(Fastcomp.class.getResource("/fastcomp/dberror.png")));
		lblStatus.setBounds(30, 180, 60, 60);
		telaLogin.add(lblStatus);
		
		txtPassword = new JPasswordField();
		txtPassword.setFont(new Font("SansSerif", Font.PLAIN, 14));
		txtPassword.setBounds(90, 118, 276, 28);
		telaLogin.add(txtPassword);
		
		JButton btnLogin = new JButton("Login");
		btnLogin.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				logar();
			}
		});
		btnLogin.setCursor(Cursor.getPredefinedCursor(Cursor.HAND_CURSOR));
		btnLogin.setFont(new Font("Tahoma", Font.PLAIN, 14));
		btnLogin.setBounds(277, 200, 89, 28);
		telaLogin.add(btnLogin);
		
		conexao = ModuloConector.conectar();
		//System.out.println(conexao);
		try {
			if (conexao != null) {
				lblStatus.setIcon(new javax.swing.ImageIcon(getClass().getResource("dbok.png")));
			} else {
				lblStatus.setIcon(new javax.swing.ImageIcon(getClass().getResource("dberror.png")));
			}
			conexao.close();
		} catch (Exception e) {
			JOptionPane.showMessageDialog(null, e);
		} 
		
		
	}
}
